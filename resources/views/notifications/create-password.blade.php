<div class="tbr_email--body">
    <h1 class="tbr_email--heading">
        <strong>Halo, {{ $user->name }}</strong>
    </h1>

    <p>
        Anda telah didaftarkan sebagai {{ $user->role }} pada  Dharma Trikarya. 
        <br/>Agar dapat login untuk pertama kalinya, silahkan buat password  
        <br/>terlebih dahulu melalui tombol di bawah ini.
    </p>
    

    <center>
        <a type="button" class="tbr_btn mb-6" href="{{ $url }}">Buat Password</a>
    </center>

    <p>
        Apabila tidak mengiginkan menjadi {{ $user->role }} pada sistem kami,
        <br/>tindakan lebih lanjut yang diperlukan.
    </p>

    <div>
        Salam kami,<br />
        <span class="tbr_text--link">{{ config('app.name') }}</span>
    </div>
</div>