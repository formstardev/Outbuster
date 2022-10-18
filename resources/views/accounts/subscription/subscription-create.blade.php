@extends('layouts.account')

@section('content')
    <div class="content">
        <h2 class="inner-title">Mon abonnement</h2>
        <div class="status">
            <p>Votre abonnement actuel :
                @if (isset($current_plan))
                    <strong>{{ $current_plan->name }} -
                        Jusqu'à {{ date('d/m/Y', strtotime($current_plan->ends_at)) }}
                    </strong>
                @else
                    <strong>Vous n'avez pas d'abonnement actif</strong>
                @endif
            </p>
            <a href="{{ route('account.subscription.type') }}" class="btn">S’abonner</a>
        </div>
        <div class="img-wrap"><img src="{!! url('assets/images/my-subscription.jpg') !!}" alt="my-subscription"></div>
    </div>
@endsection
