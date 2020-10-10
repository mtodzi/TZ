@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Продукт') }}                    
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label class="font-weight-bold">{{ __('Название') }}</label>
                            <span class="float-right">{{$product->name_product}}</span>
                        </li>
                        <li class="list-group-item">
                            <label class="font-weight-bold">{{ __('Артикул') }}</label>
                            <span class="float-right">{{$product->vendor_code}}</span>
                        </li>
                    </ul>
                </div>
                <ul class="list-unstyled m-3">
                @foreach ($urls as $url)    
                    <li class="media mb-1">
                        <img src="{{ $url }}" width="50" height="50" class="mr-3" alt="...">
                      <div class="media-body">
                            <span class="text-center">{{ $url }}</span>
                            <button onclick="confirm('Вы точно хотите удалить картинку?')" form="destroyImg{{$loop->index}}" type="submit" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button>
                            <form method="POST" action="{{ route('product.img.destroy',['product'=>$product, 'img'=>$loop->index]) }}" id="destroyImg{{$loop->index}}">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name ="url" value="{{ $url }}">
                            </form> 
                      </div>
                    </li>
                @endforeach    
                </ul>
                <div class="card-footer">
                    <div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic example">                        
                        <a href="{{route('product.edit',['product'=>$product])}}" type="button" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                        <a href="{{route('product.loading',['product'=>$product])}}" type="button" class="btn btn-warning"><i class="fas fa-camera"></i></a>
                        <button onclick="confirm('Вы точно хотите удалить продукт?')" form="destroy{{$product->id}}" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" action="{{ route('product.destroy',['product'=>$product]) }}" id="destroy{{$product->id}}">
                            @csrf
                            @method('DELETE')                                            
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
