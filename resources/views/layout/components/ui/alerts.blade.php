@if (session('erro'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Erro! 😭',
            subtitle: '',
            body: "{{session('erro')}}",
        })    
    </script>
@endif

@if (session('sucesso'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Sucesso! 😁',
            subtitle: '',
            body: "{{session('sucesso')}}",
        })    
    </script>
@endif

@foreach ($errors->all() as $erro)
    <script>
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Erro! 😭',
            subtitle: '',
            body: "{{$erro}}",
        })    
    </script>   
@endforeach

