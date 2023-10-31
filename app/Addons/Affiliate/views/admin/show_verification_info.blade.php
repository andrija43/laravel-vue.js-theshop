@extends('backend.layouts.app')

@section('content')
    @php
        $info = json_decode($affiliate_user->informations);
    @endphp

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Affiliate User Verification') }}</h5>
        </div>
        <div class="card-body row">
            <div class="col-md-6">
                <h6 class="mb-4">{{ translate('User Info') }}</h6>
                <p class="text-muted">
                    <strong>{{ translate('Name') }} :</strong>
                    <span class="ml-2">{{ $affiliate_user->user->name }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Email') }} :</strong>
                    <span class="ml-2">{{ $affiliate_user->user->email }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Phone') }} :</strong>
                    <span class="ml-2">{{ $affiliate_user->user->phone }}</span>
                </p>
            </div>

            <div class="col-md-6">
                <h6 class="mb-4">{{ translate('Verification Info') }}</h6>
                <p class="text-muted">
                    <strong>{{ translate('Name') }} :</strong>
                    <span class="ml-2">{{ $info->name }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Email') }} :</strong>
                    <span class="ml-2">{{ $info->email }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Phone') }} :</strong>
                    <span class="ml-2">{{ $info->phone }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Name') }} :</strong>
                    <span class="ml-2">{{ $info->name }}</span>
                </p>
                <p class="text-muted">
                    <strong>{{ translate('Description') }} :</strong>
                    <span class="ml-2">{{ $info->description }}</span>
                </p>
            </div>
        </div>
        
        <div class="text-center">
            @if ($affiliate_user->status == 1)
                <a href="{{ route('affiliate_user.approval', ['id' => $affiliate_user->id, 'status' => '0']) }}"
                    class="btn btn-sm btn-danger d-innline-block">{{ translate('Reject') }}</a></li>
            @elseif($affiliate_user->status == 0)
                <a href="{{ route('affiliate_user.approval', ['id' => $affiliate_user->id, 'status' => '1']) }}"
                    class="btn btn-sm btn-success d-innline-block">{{ translate('Accept') }}</a></li>
            @endif
        </div>
    </div>
@endsection
