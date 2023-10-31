@extends('backend.layouts.app')

@section('content')

<div class="row">
    {{-- Basic Affiliate --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 h6">{{ translate('Basic Affiliate')}}</h6>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('affiliate.config_store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="type" value="user_registration_first_purchase">
                        <div class="col-lg-4">
                            <label class="control-label">{{ translate('User Registration & First Purchase')}}</label>
                        </div>
                        <div class="col-lg-6">
                            @php
                                $user_registration_first_purchase = \App\Models\AffiliateOption::where('type', 'user_registration_first_purchase')->first(); 
                                $percentage = $user_registration_first_purchase->percentage;
                                $status = $user_registration_first_purchase->status;
                            @endphp
                            <input type="number" min="0.01" step="0.01" max="100" class="form-control" name="percentage" value="{{ $percentage }}" placeholder="Percentage of Order Amount" required>
                        </div>
                        <div class="col-lg-2">
                            <label class="control-label">%</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="control-label">{{ translate('Status')}}</label>
                        </div>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input value="1" name="status" type="checkbox" @if ($status)
                                       checked
                                       @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Affiliate Link Validatin Time --}}
    <div class="col-md-6">
        <div class="card bg-gray-light">
            <div class="card-header">
                <h3 class="mb-0 h6">{{ translate('Affiliate Link Validatin Time (Days)')}}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('settings.update') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label">{{ translate('Validation Time')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group mb-3">
                                <input type="hidden" name="types[]" value="validation_time">
                                <input type="number" class="form-control" placeholder="{{ translate('No of Days') }}" name="validation_time" value="{{ get_setting('validation_time') }}" min="1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 mx-auto mt-4">
    <div class="card bg-gray-light">
        <div class="card-header">
            <h5 class="mb-0 h6">
                <i>{{ translate('N:B: You can not enable Single Product Sharing Affiliate and Category Wise Affiliate at a time.') }}</i>
            </h5>
        </div>
    </div>
</div>

<div class="row">
     {{-- Product Sharing Affiliate (Category Wise) --}}
     <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6">{{ translate('Product Sharing Affiliate (Category Wise)')}}</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('affiliate.config_store') }}" method="POST">
                    @csrf
                    @php
                        $category_wise_affiliate = \App\Models\AffiliateOption::where('type', 'category_wise_affiliate')->first();
                        $category_wise_affiliate_status = $category_wise_affiliate->status;

                    @endphp
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="control-label">{{ translate('Status')}}</label>
                        </div>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input value="1" name="status" type="checkbox" @if ($category_wise_affiliate_status) checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="type" value="category_wise_affiliate">
                    @foreach (\App\Models\Category::all() as $key => $category)
                        @php
                            $found = false;
                        @endphp
                        @if($category_wise_affiliate->details != null)
                            @foreach (json_decode($category_wise_affiliate->details) as $key => $data)
                                @if($data->category_id == $category->id)
                                    @php
                                        $found = true;
                                        $value = $data;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if ($found)
                            <div class="form-group row">
                                <div class="col-lg-5">
                                    <input type="hidden" name="categories_id_{{ $value->category_id }}" value="{{ $value->category_id }}">
                                    <input type="text" class="form-control" value="{{ \App\Models\Category::find($value->category_id)->name }}" readonly>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" min="0" step="0.01" class="form-control" name="commison_amounts_{{ $value->category_id }}" value="{{ $value->commission }}">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control aiz-selectpicker" name="commison_types_{{ $value->category_id }}">
                                        <option value="amount" @if($value->commission_type == 'amount') selected @endif>$</option>
                                        <option value="percent" @if($value->commission_type == 'percent') selected @endif>%</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <div class="col-lg-5">
                                    <input type="hidden" name="categories_id_{{ $category->id }}" value="{{ $category->id }}">
                                    <input type="text" class="form-control" value="{{ $category->getTranslation('name') }}" readonly>
                                </div>
                                <div class="col-lg-4">
                                    <input type="number" min="0" step="0.01" class="form-control" name="commison_amounts_{{ $category->id }}" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control aiz-selectpicker" name="commison_types_{{ $category->id }}">
                                        <option value="amount">$</option>
                                        <option value="percent">%</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Product Sharing Affiliate --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6">{{ translate('Product Sharing Affiliate')}}</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="type" value="product_sharing">
                        <label class="col-lg-3 col-from-label">{{ translate('Product Sharing and Purchasing')}}</label>
                        <div class="col-lg-6">
                            @php
                            $product_sharing_affiliate = \App\Models\AffiliateOption::where('type', 'product_sharing')->first();
                            $status = $product_sharing_affiliate->status;
                            if($product_sharing_affiliate != null && $product_sharing_affiliate->details != null){
                                $commission_product_sharing = json_decode($product_sharing_affiliate->details)->commission;
                                $commission_type_product_sharing = json_decode($product_sharing_affiliate->details)->commission_type;
                            }
                            else {
                                $commission_product_sharing = null;
                                $commission_type_product_sharing = null;
                            }
                            @endphp
                            <input type="number" min="0.01" step="0.01" max="100" class="form-control" name="amount" value="{{ $commission_product_sharing }}" placeholder="Percentage of Order Amount" required>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control aiz-selectpicker" name="amount_type">
                                <option value="amount" @if ($commission_type_product_sharing == "amount") selected @endif>$</option>
                                <option value="percent" @if ($commission_type_product_sharing == "percent") selected @endif>%</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="control-label">{{ translate('Status')}}</label>
                        </div>
                        <div class="col-lg-8">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input value="1" name="status" type="checkbox" @if ($status) checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
