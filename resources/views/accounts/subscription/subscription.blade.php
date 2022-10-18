@extends('layouts.account')

@section('content')
    <div class="content my-subcription12">
        <div class="selected">
            <h2 class="title">{!! $current_plan->name !!}</h2>
            <div class="detail">
                <p>Votre abonnement actuel : <strong>{!! $current_plan->amount !!} €</strong></p>
                <div class="change-state">
                    <a href="{{ route('account.subscription.type') }}">Modifier votre abonnement</a>
                    <a href="javascript:;" id="cancel-btn">Annuler votre abonnement</a>
                </div>
            </div>
        </div>
        <div class="selected payment-option">
            <h2 class="title">Informations de paiements</h2>
            <div class="detail">
                <div class="detail-text">
                    @if($user->stripe_id)
                    <p>Votre type de paiement actuel : <strong><img src="{!! url('assets/images/'. $user->pm_type.'.png') !!}"> .... .... ....
                            {{$user->pm_last_four}}</strong></p>
                    @endif
                    <p>Prochaine date de facturation : <strong>{{ date("d/m/Y", strtotime($next_time))}}</strong></p>
                </div>
                {{-- <div class="change-state">
                    <a href="{{ route('account.payment.manage') }}">Gérer les informations de paiements</a>
                    <a href="#0">Modifier le jour de facturation</a>
                    <a href="#0">Détail de facturation</a>
                </div> --}}
            </div>
        </div>
        <div class="payment-options">
            <h5 class="payment-text">Types de paiement acceptés</h5>
            <div class="pay-option-images">
                <a href="#0"><img src="{!! url('assets/images/pay1.png') !!}" alt="payment"></a>
                <a href="#0"><img src="{!! url('assets/images/pay2.png') !!}" alt="payment"></a>
                <a href="#0"><img src="{!! url('assets/images/pay3.png') !!}" alt="payment"></a>
                <a href="#0"><img src="{!! url('assets/images/pay4.png') !!}" alt="payment"></a>
                <a href="#0"><img src="{!! url('assets/images/pay5.png') !!}" alt="payment"></a>
            </div>
        </div>
    </div>
    <div class="cancel-subscription-pop popup" id="alert-pop">
        <h4 class="form-body">Êtes-vous sûr de vouloir résilier votre abonnement ?</h4>
        <p></p>
        <button class="form-control btn" id="cancel-subscription-btn"
            style="background-color: var(--brand-clr1); color: var(--dark-clr);">Confirmer</button>
    </div>
    <script type="text/javascript">
        $(function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');
            $('#cancel-btn').click(function(e) {
                e.stopPropagation();
                $('.cancel-subscription-pop').addClass('show');
                $('html').removeClass('overflow');
            });
            $(document).click(function() {
                $('.cancel-subscription-pop').removeClass('show');
            });
            $('#cancel-subscription-btn').click(function() {
                
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: "{{ route('account.subscription.cancel') }}",
                    data: {
                        'type': 1,
                    },
                    success: function(response) {
                        window.location.href = "{{ route('account.subscription.create') }}";
                    }
                });

                
            });
        });
    </script>
@endsection
