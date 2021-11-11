@section('title')
Create Categories &mdash; {{ $setting->admin_title }}
@endsection

<div class="row justify-content-center">
    <div class="col-md-12">
        @if (session()->has('error_image'))
        <div class="alert alert-danger">
            {{ session('error_image') }}
        </div>
        @endif
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-folder"></i> ADD CATEGORY
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">

                            @if($image)
                            <div class="text-center">
                                <img src="{{ $image->temporaryUrl() }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                                    <p>PREVIEW</p>
                            </div>
                            @else
                                <div class="text-center">
                                <img src="{{ asset('images/image.png') }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                                    <p>PREVIEW</p>
                                </div>
                            @endif
                              {{-- <img src="{{ asset('images/image.png') }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                                    <p>PREVIEW</p>
                                </div> --}}

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image</label>
                                <small>Hanya support PNG</small>

                                <input type="file" id="image" class="form-control" wire:model="image"
                                    required>
                                @error('image')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" wire:model.lazy="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Category Name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <button type="reset" class="btn btn-warning">RESET</button>
                </form>
            </div>
        </div>
    </div>
</div>
