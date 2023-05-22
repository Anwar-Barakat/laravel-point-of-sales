 @if ($account->current_balance > 0)
     <span>( {{ __('account.debit') }} )</span>
     <span class="badge bg-green-lt">{{ $account->current_balance }}</span>
 @elseif($account->current_balance < 0)
     <span>( {{ __('account.credit') }} )</span>
     <span class="badge bg-red-lt">{{ $account->current_balance }}</span>
 @else
     <span>( {{ __('account.balanced') }} )</span>
     <span class="badge badge-dark">{{ $account->current_balance }}</span>
 @endif
