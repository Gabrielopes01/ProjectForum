<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <form method="POST">
            <h3 class="light"; align="left">Adicionar Usuário</h3>
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="email" name="email" id="email">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha">
                <label for="senha">Senha</label>
            </div>
        

<hr>
        <button type="submit" class="btn green" style="float: right; margin-left: 10px"><i class="material-icons">check</i> Adicionar</button>
        <a href="/admin" class="btn" style="float: right"><i class="material-icons">keyboard_return</i> Voltar</a>
        </form>
    </div>
</div>