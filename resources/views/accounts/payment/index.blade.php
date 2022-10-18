@extends('layouts.account')
@section('content')
    <div class="content my-payment">
        <div class="selected">
            <h2 class="title">Mon abonnement <b>en cours</b></h2>
            @if (isset($current_plan))
                <p>Votre abonnement actuel : <strong>{{ $current_plan->name }}</strong></p>
                @if ($current_plan->ends_at)
                    <p>Résilié le :
                        <strong>{{ date('d/m/Y', strtotime($current_plan->ends_at)) }}</strong>
                    </p>
                @else
                    <p>Prochaine date de facturation :
                        <strong>{{ date('d/m/Y', strtotime($next_time)) }}</strong>
                    </p>
                @endif
            @else
                <strong>Vous n'avez pas d'abonnement actif</strong>
            @endif
        </div>
        @if(count($transactions)>0)
        <div class="responsive-table">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Période</th>
                    <th>Mode de paiement</th>
                    {{-- <th>Sous total</th> --}}
                    <th>Amount</th>
                    {{-- <th>Actions</th> --}}
                </tr>
                @foreach ($transactions as $item)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Du {{ date('d/m/Y', strtotime($item->created_at)) }} au
                            {{ date('d/m/Y', strtotime($item->expiration_date)) }}
                        </td>
                        <td>
                            <img src="{!! url('assets/images/' . $user->pm_type . '.png') !!}" alt="{{ $user->pm_type }}"> .... .... ....
                            {{ $user->pm_last_four }}
                            {{-- <img src="{!! url('assets/images/mastercard.png') !!}" alt="visa"> .... .... .... 3410 --}}
                        </td>
                        {{-- <td>8,33 € + 1,66 € TVA</td> --}}
                        <td>{{ $item->amount }} €</td>
                        {{-- <td>
                            <a href="#0"><img src="{!! url('assets/images/eye-small.png') !!}" alt="small"></a>
                            <a href="#0"><img src="{!! url('assets/images/download-small.png') !!}" alt="small"></a>
                        </td> --}}
                    </tr>
                @endforeach
            </table>
        </div>
        <p class="note">Note : l’historique de vos facturations est disponible sur les 12 derniers mois uniquement.</p>
        @endif
    </div>
@endsection
