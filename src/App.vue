
<template>
 <button v-on:click="buscar()" class="w3-button w3-blue">Buscar Cursos</button>
    <br><br><br>
    <table class="w3-table w3-bordered w3-card" v-if="cursos != ''">
        <tr>
            <td>Codigo</td>
            <td>Curso</td>
            <td>Vagas</td>
            <td>Periodo</td>
            <td>Ano</td>
            <td>Semestre</td>
        </tr>
        <tr v-for="curso in cursos">
            <td>{{ curso.cod }}</td>
            <button v-on:click="buscar_aluno(curso.cod)"><td>{{ curso.curso }}</td></button> 
            <td>{{ curso.vagas }}</td>
            <td>{{ curso.periodo }}</td>
            <td>{{ curso.ano }}</td>
            <td>{{ curso.semestre }}</td>
        </tr>
    </table>
    <table class="w3-table w3-bordered w3-card" v-if="alunos != ''">
        <tr>
            <td>Codigo</td>
            <td>Código Curso</td>
            <td>Nome</td>
            <td>Idade</td>
        </tr>
        <tr v-for="aluno in alunos">
            <td>{{ aluno.cod }}</td> 
            <td>{{ aluno.cod_curso }}</td>
            <td>{{ aluno.nome }}</td>
            <td>{{ aluno.idade }}</td>
        </tr>
    </table>
</template>

<script>
    export default{
    data() {
        return {
           aluno: "",
           cursos: "",
        };
    },
    methods: {
      async buscar(){
        const retorno = await fetch("http://localhost:8081/cursos.php"); 
        this.cursos = await retorno.json();
      },   
      async buscar_aluno(fk_cod_curso){
        const retorno = await fetch("http://localhost:8081/aluno.php?cod_cursos=" + fk_cod_curso); 
        this.alunos = await retorno.json();
      }   
    }

    }
</script>