@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Blog Categories')}}</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="@if(auth()->user()->can('add_blog_category')) col-lg-7 @else col-lg-12 @endif">
        <div class="card">
            <div class="card-header d-block d-md-flex">
                <h5 class="mb-0 h6">{{ translate('Blog Categories') }}</h5>
                <form class="" id="sort_categories" action="" method="GET">
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>{{translate('Name')}}</th>
                            <th width="20%" class="text-right">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                            <td>{{ $category->getTranslation('name') }}</td>
                            <td class="text-right">
                                @can('edit_blog_category')
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route('blog-category.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                        title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                @endcan
                                @can('delete_blog_category')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('blog-category.destroy', $category->id)}}" title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
    @can('add_blog_category')
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Add New Blog Category')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('blog-category.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Name') }}</label>
                            <input type="text" placeholder="{{ translate('Name') }}" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{translate('Save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
</div>
@endsection

@section('modal')
    @include('backend.inc.delete_modal')
@endsection

