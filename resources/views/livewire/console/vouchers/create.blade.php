@section('title')
Tambah Voucher &mdash; {{ $setting->admin_title }}
@endsection

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-award"></i> ADD VOUCHER
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">

                    <div class="row">
                        <div class="col-md-12">
                            @if($image)
                            <div class="text-center">
                                <img src="{{ $image->temporaryUrl() }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                            </div>
                            @else
                                <div class="text-center">
                                <img src="{{ asset('images/image.png') }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                                    <p>PREVIEW</p>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" id="image" class="form-control" wire:model="image"
                                    >
                                @error('image')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" wire:model.lazy="title"
                                            class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kode Voucher</label>
                                        <input type="text" wire:model.lazy="voucher"
                                            class="form-control @error('voucher') is-invalid @enderror" placeholder="Kode Voucher">
                                        @error('voucher')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nominal Voucher</label>
                                        <input type="number" wire:model.lazy="nominal_voucher"
                                            class="form-control @error('nominal_voucher') is-invalid @enderror" placeholder="Nominal Voucher">
                                        @error('nominal_voucher')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Minimal Shopping</label>
                                        <input type="number" wire:model.lazy="total_minimal_shopping"
                                            class="form-control @error('total_minimal_shopping') is-invalid @enderror" placeholder="Total Minimal Shopping">
                                        @error('total_minimal_shopping')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" rows="4" wire:model.lazy="content">{{ $content }}</textarea>
                                @error('content')
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
