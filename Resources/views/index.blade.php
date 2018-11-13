@extends('layouts.app')

@section('title')
	{{ trans('currency::currencies.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-md-7 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('currency::currencies.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
        <div class="col-md-5 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('currency::currencies.add_currency') }}</button>
                </div>
                
            </div>
        </div>
    </div>
          
    <!-- Countries table -->
    <div class="row">
        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
                  <ul class="no-margin" style="margin: 0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              <br>
            @endif
            @if(session('action'))
                <div class="alert alert-success">
                    {{ trans('currency::currencies.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('currency::currencies.added_currencies')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="15%">@lang('currency::currencies.table.id')</th>
                                    <th width="60%">@lang('currency::currencies.table.name')</th>
                                    <th width="25%" class="text-nowrap">@lang('currency::currencies.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($currencies as $currency)
                                <tr>
                                    <td>{{$currency->id}}</td>
                                    <td>@lang("currencies-list.$currency->slug")</td>

                                    <td class="text-nowrap">
                                        <a class="btn btn-warning" 
                                            href="{{ route('currency.modify', $currency->id) }}" 
                                            data-toggle="tooltip" 
                                            data-original-title="Edit">
                                            <i class="fas fa-pencil-alt text-white"></i>
                                        </a>
                                        
                                        <form  class="form-delete" method="POST" 
                                            style="display: inline-block;" 
                                            action="{{ route('currency.destroy', $currency->id) }}"> 
                                            @csrf
                                            @method('delete')
                                            <button name="delete-modal" data-toggle="tooltip" data-original-title="Delete" class="btn text-white btn-danger"> <i class="fas fa-trash"></i> 
                                            </button>
                                        </form>  
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">@lang('currency::currencies.table.empty')</td>
                                </tr>
                                @endforelse

                                {{ $currencies->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- sample modal content -->
    @include('currency::modals.new')
    @include('currency::modals.delete')
@stop

@section('scripts')
    <script type="text/javascript">  
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });
    </script>
@stop