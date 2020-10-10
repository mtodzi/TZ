@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold">{{ __('Продукты') }}</span>
                    <a href="{{route('product.create')}}" type="button" class="btn btn-success float-right"><i class="fas fa-plus-square"></i></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">{{ __('№') }}</th>
                            <th class="text-center" scope="col">{{ __('Название') }}</th>
                            <th class="text-center" scope="col">{{ __('Артикул') }}</th>
                            <th class="text-right" scope="col">{{ __('Действие') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center">{{$product->name_product}}</td>
                                <td class="text-center">{{$product->vendor_code}}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="{{route('product.show',['product'=>$product])}}" type="button" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="#" v-on:click='get_product_value({{ $product->id }})' type="button" class="btn btn-secondary"><i class="fab fa-js"></i></i></a>
                                        <a href="{{route('product.edit',['product'=>$product])}}" type="button" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                        <a href="{{route('product.loading',['product'=>$product])}}" type="button" class="btn btn-warning"><i class="fas fa-camera"></i></a>
                                        <button onclick="confirm('Вы точно хотите удалить продукт?')" form="destroy{{$product->id}}" type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        <form method="POST" action="{{ route('product.destroy',['product'=>$product]) }}" id="destroy{{$product->id}}">
                                            @csrf
                                            @method('DELETE')                                            
                                        </form>    
                                    </div>
                                </td>
                            </tr>    
                            @endforeach                      
                        </tbody>
                    </table>                        
                </div>
                <div class="card-footer">
                    {{  $products->links() }}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label class="font-weight-bold">{{ __('Название') }}</label>
                            <span class="float-right">@{{ name_product }}</span>
                        </li>
                        <li class="list-group-item">
                            <label class="font-weight-bold">{{ __('Артикул') }}</label>
                            <span class="float-right">@{{ vendor_code }}</span>
                        </li>
                    </ul>
                    <ul class="list-unstyled m-3" v-for="(url,index) in urls" :key="index">    
                        <li class="media mb-1">
                            <img width="50" height="50" v-bind:src="url"  class="mr-3" alt="...">
                            <div class="media-body">
                                <span class="text-center">@{{ url }}</span>
                            </div>
                        </li>   
                    </ul>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
