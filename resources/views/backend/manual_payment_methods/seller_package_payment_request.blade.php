@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Offline Seller Package Payment Requests')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Package')}}</th>
                    <th>{{translate('Method')}}</th>
                    <th>{{translate('TXN ID')}}</th>
                    <th>{{translate('Reciept')}}</th>
                    <th>{{translate('Approval')}}</th>
                    <th>{{translate('Date')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($package_payment_requests as $key => $package_payment_request)
                    @if ($package_payment_request->user != null)
                        <tr>
                            <td>{{ ($key+1) }}</td>
                            <td>{{ $package_payment_request->user->name}}</td>
                            <td>{{ optional($package_payment_request->seller_package)->name }}</td>
                            <td>{{ $package_payment_request->payment_method }}</td>
                            <td>{{ $package_payment_request->transaction_id }}</td>
                            <td>
                                @if ($package_payment_request->reciept != null)
                                    <a href="{{ my_asset($package_payment_request->reciept) }}" target="_blank">{{translate('Open Reciept')}}</a>
                                @endif
                            </td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input 
                                        @can('approve_offline_seller_package_payment') 
                                            onclick="offline_payment_approval('{{ route('offline_seller_package_payment.approved', $package_payment_request->id )}}')"
                                        @endcan
                                        id="payment_approval" 
                                        type="checkbox"
                                        @if($package_payment_request->approval == 1) checked disabled @endif 
                                        @cannot('approve_offline_seller_package_payment') disabled @endcan>
                                    
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>{{ $package_payment_request->created_at }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $package_payment_requests->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
<div id="payment-approval-modal" class="modal fade">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-zoom">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Offline Seller Package Payment Confirmation')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <i class="la la-4x la-warning text-warning mb-4"></i>
                <p class="fs-18 fw-600 mb-1">{{ translate('Are you sure to approve this?') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a href="" id="approve-link" class="btn btn-primary mt-2">{{translate('Yes, Approve')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function offline_payment_approval(url){
            $("#payment-approval-modal").modal("show");
            $("#approve-link").attr("href", url);
        }
    </script>
@endsection
