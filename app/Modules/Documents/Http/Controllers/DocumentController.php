<?php

namespace Modules\Documents\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Documents\Http\Requests\StoreDocumentFileRequest;
use Modules\Documents\Models\DocumentFile;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('documents::index');
    }

    public function grid(): JsonResponse
    {
        $files = DocumentFile::with('user')
            ->orderByDesc('created_at')
            ->get();

        $data = [];
        foreach ($files as $row) {
            $uploadedBy = $row->user
                ? $row->user->first_name.' '.$row->user->last_name
                : '-';

            $data[] = [
                'id' => $row->id,
                'original_name' => $row->original_name,
                'size' => $row->size_for_humans,
                'mime_type' => $row->mime_type ?? '-',
                'uploaded_by' => $uploadedBy,
                'created_at' => $row->created_at->format('Y-m-d H:i'),
                'action' => '<a class="btn btn-success btn-download" href="'.route('documents.download', $row->id).'" data-id="'.$row->id.'" title="Pobierz"><i class="fas fa-download"></i></a> <a class="btn btn-danger delete-button" data-id="'.$row->id.'" href="#"><i class="fas fa-trash-alt"></i></a>',
            ];
        }

        return response()->json($data);
    }

    public function store(StoreDocumentFileRequest $request): JsonResponse
    {
        $uploaded = $request->file('file');
        $path = $uploaded->store('documents', 'local');

        DocumentFile::create([
            'name' => $path,
            'original_name' => $uploaded->getClientOriginalName(),
            'size' => $uploaded->getSize(),
            'mime_type' => $uploaded->getMimeType(),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'success' => module_trans('Documents', 'messages.file_uploaded'),
        ]);
    }

    public function download(int $id): Response|\Symfony\Component\HttpFoundation\StreamedResponse
    {
        $file = DocumentFile::findOrFail($id);

        if (! Storage::disk('local')->exists($file->name)) {
            abort(404);
        }

        return Storage::disk('local')->download(
            $file->name,
            $file->original_name,
            [
                'Content-Type' => $file->mime_type ?? 'application/octet-stream',
            ]
        );
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $file = DocumentFile::findOrFail($id);

        if (Storage::disk('local')->exists($file->name)) {
            Storage::disk('local')->delete($file->name);
        }

        $file->delete();

        return response()->json([
            'message' => module_trans('Documents', 'messages.file_deleted'),
        ]);
    }
}
