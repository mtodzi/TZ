@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Обновить продукт') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('product.update',['product'=>$product]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Название') }}</label>
                            <div class="col-md-6">
                                <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product" value="{{ $product->name_product }}" required autocomplete="name_product" autofocus>

                                @error('name_product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Артикул') }}</label>
                            <div class="col-md-6">
                                <input id="vendor_code" type="text" class="form-control @error('vendor_code') is-invalid @enderror" name="vendor_code" value="{{ $product->vendor_code }}" required autocomplete="vendor_code" autofocus>

                                @error('vendor_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Обновить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
