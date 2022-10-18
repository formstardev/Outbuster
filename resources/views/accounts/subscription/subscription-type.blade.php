@extends('layouts.account')

@section('content')
    <div class="content my-subcription11">
        <div class="status">
            <h2 class="inner-title">Type d’abonnement</h2>
            <p>Choisir une formule d’abonnement</p>
        </div>
        <div class="plans">
            @foreach ($plans as $plan)
                <label class="radio-lebel subscription-plan" data-stripe="{{ $plan->stripe_plan_id }}"
                    data-paypal="{{$plan->paypal_plan_id}}">
                    <input type="radio" name="radio" value="{{ $plan->id }}">
                    <span class="checkmark"></span>
                    <div class="plan-text">
                        <div class="txt">
                            <h3 class="plan-title">{{ $plan->name }} - {{ $plan->amount }} €</h3>
                            <p>Accès illimités aux films & séries</p>
                        </div>
                        <span class="action" id="action">Choisir cette formule</span>
                    </div>
                </label>
            @endforeach
            <div class="btn-wrap">
                <a class="btn btn-gray" href="{{ route('account.subscription') }}">Annuler</a>
                <a class="btn btn-black">Valider ma formule</a>
            </div>
        </div>
    </div>

    <div class="select-gateway-pop popup">
        <h1 class="form-title">Sélectionnez un mode de paiement.</h1>
        <a class="btn btn-blue" id="stripe_btn">Stripe</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-blue" id="paypal_btn">PayPal</a>
        {{-- <form>
            <button type="button" class="form-control btn"> Stripe</button>
            <button type="button" class="form-control btn"> PayPal</button>
        </form> --}}
    </div>

    <div class="select-subscription-pop popup" id="alert-pop">
        <h4 class="form-body">Vous devez choisir une formule d'abonnement !</h4>
    </div>

    <script>
        var stripe_id = '';
        var paypal_id = '';
        $('.subscription-plan').click(function() {
            stripe_id = $(this).data("stripe");
            paypal_id = $(this).data("paypal");
        })
        $('.btn-black').click(function(e) {
            if (stripe_id && paypal_id) {
                e.stopPropagation();
                $('.select-gateway-pop').addClass('show');
                $('html').removeClass('overflow');
            } else {
                e.stopPropagation();
                $('.select-subscription-pop').addClass('show');
                $('html').removeClass('overflow');
            }
        })
        $('#stripe_btn').click(function(e) {
            var url = "{{ route('stripe.redirect', ':id') }}";
            url = url.replace(':id', stripe_id);
            window.location.href = url;
        });
        $('#paypal_btn').click(function(e) {
            var url = "{{ route('paypal.redirect', ':id') }}";
            url = url.replace(':id', paypal_id);
            window.location.href = url;
        });
        $(document).click(function() {
            $('.select-gateway-pop').removeClass('show');
            $('.select-subscription-pop').removeClass('show');
        });
    </script>
@endsection
