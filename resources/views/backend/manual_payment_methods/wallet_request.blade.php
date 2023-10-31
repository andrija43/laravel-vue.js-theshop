@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Offline Wallet Recharge Requests')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Amount')}}</th>
                    <th>{{translate('Method')}}</th>
                    <th>{{translate('TXN ID')}}</th>
                    <th>{{translate('Receipt')}}</th>
                    <th>{{translate('Approval')}}</th>
                    <th>{{translate('Date')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wallets as $key => $wallet)
                    @if ($wallet->user != null)
                        <tr>
                            <td>{{ ($key+1) }}</td>
                            <td>{{ $wallet->user->name }}</td>
                            <td>{{ $wallet->amount }}</td>
                            <td>{{ $wallet->payment_method }}</td>
                            <td>{{ $wallet->payment_details }}</td>
                            <td>
                                @if ($wallet->reciept != null)
                                    <a href="{{ my_asset($wallet->reciept) }}" target="_blank">{{translate('Open Reciept')}}</a>
                                @endif
                            </td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input 
                                        @if(auth()->user()->can('approve_offline_wallet_recharge') && $wallet->approval == 0)
                                            onclick="update_approved('{{ route('offline_recharge_request.approved', $wallet->id )}}')"
                                        @endcan
                                        type="checkbox" 
                                        @if($wallet->approval == 1) checked disabled @endif 
                                        @cannot('approve_offline_wallet_recharge') disabled @endcan >
                                        <span class="slider round"></span>
                                </label>
                            </td>

                            <td>{{ $wallet->created_at }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $wallets->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
<div id="payment-approval-modal" class="modal fade">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-zoom">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Offline Wallect Recharge Confirmation')}}</h4>
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
        function update_approved(url){
            $("#payment-approval-modal").modal("show");
            $("#approve-link").attr("href", url);
        }
    </script>
@endsection
