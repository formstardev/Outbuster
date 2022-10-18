<li><a href="#0" class="go-to-profile"><img
            src="{{ auth()->user()->avatar == '' ? url('assets/images/profile-picture.png') : url('storage/' . auth()->user()->avatar) }}"
            alt=""></a>
    <ul class="profile-option dropdown">
        <li><a href="{{ route('account.subscription') }}">Mon abonnement</a></li>
        <li><a href="{{ route('account.profile') }}">Mon profil</a></li>
        <li><a href="{{ route('account.playlist') }}">Ma playlist</a></li>
        <li><a href="{{ route('account.payment') }}">Mes paiements</a></li>
        <li><a href="{{ route('logout.perform') }}">Se déconnecter</a></li>

    </ul>
</li>

<style>
    .go-to-profile>img {
        width: 26px;
        height: 26px;
    }
</style>
