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
            <button v-on:click="buscar_aluno(curso.cod)">
                <td>{{ curso.curso }}</td>
            </button>
            <td>{{ curso.vagas }}</td>
            <td>{{ curso.periodo }}</td>
            <td>{{ curso.ano }}</td>
            <td>{{ curso.semestre }}</td>
        </tr>
    </table>
    <table class="w3-table w3-bordered w3-card" v-if="alunos.length > 0">
        <tr>
            <td>Codigo</td>
            <td>Nome</td>
            <td>Código Curso</td>
            <td>Idade</td>
        </tr>
        <tr v-for="aluno in alunos" :key="aluno.id">
            <td>{{ aluno.id }}</td>
            <td>{{ aluno.nome }}</td>
            <td>{{ aluno.curso }}</td>
            <td>{{ aluno.idade }}</td>
        </tr>
    </table>
</template>

<script>
export default {
    data() {
        return {
            alunos: "",
            cursos: ""
        };
    },
    methods: {
        async buscar() {
            const retorno = await fetch("http://localhost:8081/pw3-etec/api/cursos.php");
            this.cursos = await retorno.json();
        },
        async buscar_aluno(cod_curso) {
            const retorno = await fetch(`http://localhost:8081/pw3-etec/api/aluno.php?cursos=${cod_curso}`);
            this.alunos = await retorno.json();
        }
    }


}
</script>