@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="loadCategorias(); loadLinks();">Link's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="loadCategorias()">Categoria</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form id="formLink">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Link:</label>
                                        <input type="text" class="form-control" id="input_link" placeholder="Link">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Categorias:</label>
                                        <select class="form-control" id="selectCategorias">
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block ">Cadastrar Link</button>
                                </form>
                            <table class="table table-hover mt-5" id="tableLinks">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form id="formCategoria">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Categoria:</label>
                                        <input type="text" class="form-control" id="input_nome_categoria" placeholder="Nome"  minlength="3" maxlength="55" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Cadastrar Categoria</button>
                                </form>
                                <table class="table table-hover mt-5" id="tableCategoria">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // onload - Select e Tabela Categorias
    loadCategorias()

    // onload - Select e Tabela Link
    loadLinks()


    // Botão Submit link
    $( "#formLink" ).submit(function( event ) {
        const input = $('#input_link');
        const select = $('#selectCategorias');
        console.log('teste');
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8010/api/links',
            dataType: 'json',
            data: {
                link : input.val(),
                categoria_id : select.val(),
                user_id: {{ Auth::user()->id }}
            },
            success: function (data) {
                input.val('');
                loadLinks();
                alert('cadastrado com sucesso!');
            },
            error: function (error) {

                console.log(error);
                alert('Error ao cadastrar!');
            }
        });
        event.preventDefault();
    });

    // Botão Submit Categorias
    $( "#formCategoria" ).submit(function( event ) {
        const input = $('#input_nome_categoria');
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8010/api/categorias',
            dataType: 'json',
            data: {
                nome : input.val(),
                user_id: {{ Auth::user()->id }}
            },
            success: function (data) {
                input.val('');
                loadCategorias();
                alert('cadastrado com sucesso!');
            },
            error: function (error) {
                console.log(error);
                alert('Error ao cadastrar!');
            }
        });
        event.preventDefault();
    });




    // Carregar todas categorias - Select e Tabela
    function loadCategorias(){
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8010/api/categorias',
            dataType: 'json',
            data: {
                user_id: {{ Auth::user()->id }}
            },
            success: function (data) {
                if (data.length > 0){
                    const tbodyCat = $('#tableCategoria > tbody');
                    tbodyCat.empty();
                    $('#selectCategorias').empty();
                    data.map( function (data) {
                        $(new Option(data.nome, data.id)).appendTo('#selectCategorias');
                        tbodyCat.append(`<tr id='catId${data.id}'>
                                        <th scope="row">${data.id}</th>
                                        <td><input value="${data.nome}" readonly></td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-sm" onclick="editarCat(this, ${data.id})">
                                                <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                                </svg>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="removerCat(this,${data.id})">
                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`);
                    });
                }
            },
        });
    }

    function loadLinks(){
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8010/api/links',
            dataType: 'json',
            data: {
                user_id: {{ Auth::user()->id }}
            },
            success:  function (data) {
                if (data.length > 0){
                    const tbodyLink = $('#tableLinks > tbody');
                    tbodyLink.empty();
                    data.map( function (data) {
                        tbodyLink.append(`<tr id='linkId${data.id}'>
                                        <th scope="row">${data.id}</th>
                                        <td><input value="${data.link}" readonly></td>
                                        <td>
                                        <select class="form-control" id="selectLink${data.id}" disabled readonly></select>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-warning btn-sm" onclick="editarLink(this, ${data.id})">
                                                <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                                </svg>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="removerLink(this,${data.id})">
                                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`);
                        $.ajax({
                            type: 'GET',
                            url: 'http://localhost:8010/api/categorias',
                            dataType: 'json',
                            linkId: data.id,
                            categoria_id: data.categoria_id,
                            data: {
                                user_id: {{ Auth::user()->id }}
                            }, success: function (data2) {
                                let that = this;
                                data2.map( function (data2) {
                                    if(data2.id == that.categoria_id){
                                        $(new Option(data2.nome, data2.id, true, true)).appendTo(`#selectLink${that.linkId}`);
                                    }else{
                                        $(new Option(data2.nome, data2.id)).appendTo(`#selectLink${that.linkId}`);
                                    }

                                });
                                console.log('---- ')
                            }
                        });
                    });


                }
            },
        });
    }

    function removerLink(data, id) {
        const url  = `http://localhost:8010/api/links/${id}`
        $.ajax({
            type: 'DELETE',
            url: url,
            dataType: 'json',
            remover: data,
            success: function (data) {
                $(this.remover).closest('tr').remove();
                alert('Dado removido com sucesso');
            },
            error: function (error) {
                console.log(error);
                alert('Error ao remover dado');
            },
        });
    }

    function editarLink(data, id) {
        const input = $(data).closest('tr').find('input');
        const select = $(data).closest('tr').find('select');
        if( input.prop('readonly')){
            input.prop('readonly', false);
            select.prop('disabled', false);
        }else {
            input.prop('readonly', true);
            select.prop('disabled', true);
            const url  = `http://localhost:8010/api/links/${id}`
            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    link : input.val(),
                    categoria_id : select.val()
                },
                dataType: 'json',
                success: function (data) {
                    alert('Atualizado com sucesso! com sucesso');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error ao atualizar!');
                },
            });
        }
    }

    // remover categoria
    function editarCat(data, id) {
        const input = $(data).closest('tr').find('input');
        if( input.prop('readonly') == true){
            input.prop('readonly', false);
        }else{
            input.prop('readonly', true);
            const url  = `http://localhost:8010/api/categorias/${id}`
            $.ajax({
                type: 'PUT',
                url: url,
                dataType: 'json',
                data: {
                    'nome' : input.val()
                },
                success: function (data) {
                    alert('Atualziado com sucesso!');
                },
                error: function (error) {
                    alert('Error ao atualizar');
                },
            });
        }
    }

    // remover categoria
    function removerCat(data, id) {
        const url  = `http://localhost:8010/api/categorias/${id}`
        $.ajax({
            type: 'DELETE',
            url: url,
            dataType: 'json',
            remover: data,
            success: function (data) {
                $(this.remover).closest('tr').remove();
                alert('Dado removido com sucesso');
            },
            error: function (error) {
                console.log(error);
                alert('Error ao remover dado');
            },
        });
    }
</script>
@endsection

