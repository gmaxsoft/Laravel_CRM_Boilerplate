<form method="POST" id="form_block" name="form_block" style="width:100%;">
    @csrf
    <div class="title-box">Edycja</div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" autocomplete="off" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Wpisz nazwę" value="{{ old('name', $access->name) }}" required autofocus tabindex="1" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="level">Poziom</label>
                <input type="text" autocomplete="off" class="form-control @error('level') is-invalid @enderror" required id="level" name="level" placeholder="Wpisz poziom (cyfra)" value="{{ old('level', $access->level) }}" required autofocus tabindex="2" />
                @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <hr />
    <div class="form-group">
        <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $access->id }}">
        <button type="submit" class="btn btn-primary">Uaktualnij</button>
        <button type="button" class="btn btn-danger backtolist">Powrót do listy</button>
    </div>
</form>
