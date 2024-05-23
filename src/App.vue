<template>
    <div>
      <button v-if="!showCadastro" v-on:click="buscar" class="w3-button w3-blue">Buscar Cursos</button>
      <button v-if="showCadastro" v-on:click="toggleCadastro" class="w3-button w3-red">Cancelar Cadastro</button>
      <button v-if="!showCadastro && cursos.length > 0" v-on:click="toggleCadastro" class="w3-button w3-green">Cadastrar Cursos</button>
      <br><br><br>
      <div v-if="!showCadastro">
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
            <td>
              <button v-on:click="buscar_aluno(curso.cod)">
                {{ curso.curso }}
              </button>
            </td>
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
      </div>
      <div v-if="showCadastro">
        <h3>Cadastrar Curso</h3>
        <form @submit="cadastrarCurso">
          <label for="curso">Curso:</label><br>
          <input type="text" id="curso" v-model="novoCurso.curso"><br>
          <label for="vagas">Vagas:</label><br>
          <input type="number" id="vagas" v-model="novoCurso.vagas"><br>
          <label for="periodo">Período:</label><br>
          <input type="text" id="periodo" v-model="novoCurso.periodo"><br>
          <label for="ano">Ano:</label><br>
          <input type="number" id="ano" v-model="novoCurso.ano"><br>
          <label for="semestre">Semestre:</label><br>
          <input type="number" id="semestre" v-model="novoCurso.semestre"><br><br>
          <button type="submit" class="w3-button w3-green">Cadastrar</button>
        </form>
      </div>
  
      <!-- Adicionando o botão e a seção de cadastro de aluno -->
      <div>
        <button v-if="alunos != ''" v-on:click="cadastro" class="w3-button w3-green">Cadastrar Aluno</button>
        <div v-if="cad == true">
          Nome: <input type="text" v-model="nome" required><br>
          Idade: <input type="number" v-model="idade" step="1" required><br><br>
          <button v-on:click="cadastrar">Cadastrar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        alunos: "",
        cursos: "",
        novoCurso: {
          curso: "",
          vagas: 0,
          periodo: "",
          ano: 0,
          semestre: 0
        },
        showCadastro: false,
        cad: false,
        nome: "",
        idade: 0,
        codCurso: ""
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
        this.codCurso = cod_curso;
      },
      async cadastrarCurso() {
        try {
          const response = await fetch("http://localhost:8081/pw3-etec/api/incluir_cursos.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(this.novoCurso)
          });
  
          if (response.ok) {
            // Se o curso for cadastrado com sucesso, oculte a tela de cadastro
            this.toggleCadastro();
  
            // Em seguida, chame a função de busca para atualizar os resultados
            await this.buscar();
          } else {
            console.error("Erro ao cadastrar curso");
          }
        } catch (error) {
          console.error("Erro ao cadastrar curso:", error);
        }
      },
      toggleCadastro() {
        this.showCadastro = !this.showCadastro;
      },
      // Função para controlar o cadastro de aluno
      cadastro() {
        this.cad = true;
      },
      // Função para cadastrar aluno
      async cadastrar() {
        const retorno = await fetch("http://localhost:8081/pw3-etec/api/incluir_alunos.php", {
          method: 'POST',
          body: JSON.stringify([{
            nome: this.nome,
            idade: this.idade,
            cod_curso: this.codCurso
          }]),
          headers: {
            'Content-type': 'application/json; charset=UTF-8',
          }
        });
        let r = await retorno.text();
        alert(r);
        this.cad = false;
        this.buscar_aluno(this.codCurso); // Atualiza a lista de alunos
      }
    },
    mounted() {
      this.buscar();
    }
  }
  </script>
  
  <style>
  body {
    background-color: white;
    color: #000;
  }
  
  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  .selected-row {
    background-color: #ddd;
  }
  </style>
  