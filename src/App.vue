
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
            <a href="" v-on:click="alunos()"><td>{{ curso.curso }}</td></a> 
            <td>{{ curso.vagas }}</td>
            <td>{{ curso.periodo }}</td>
            <td>{{ curso.ano }}</td>
            <td>{{ curso.semestre }}</td>
        </tr>
    </table>
</template>

<script>
    export default{
    data() {
        return {
           aluno: "",
           cursos: "" 
        };
    },
    methods: {
      async buscar(){
        const retorno = await fetch("http://localhost:8081/cursos.php"); 
        this.cursos = await retorno.json();
      },   
      async buscar_aluno(){
        const retorno = await fetch("http://localhost:8081/aluno.php"); 
        this.alunos = await retorno.json();
      },   
      async alunos(cod_curso){
        const retorno = await fetch("http://localhost:8081/aluno.php"); 
        this.alunos = await retorno.json();
      }   
    }

    }
</script>