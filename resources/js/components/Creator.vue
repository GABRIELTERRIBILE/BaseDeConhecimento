<template>
    <div>
        <h1 class="text-center"> Base de conhecimento</h1>
        <td>
            <button v-if="isLoggedIn" type="button" class="btn btn-primary" @click="goToArticle" >Novo artigo</button>
        </td>
        <div class="text-center" style="display: flex; justify-content: flex-end;">
            <input type="text" v-model="searchTerm" class="form-control mr-n2" id="exampleFormControlInput1" @keyup.enter="search" @input="search" placeholder="Buscar por assunto ou ID" style="width: 20%;">
            <button class="btn btn-outline-secondary" @click="search"><i class="bi bi-search"></i></button>
        </div>
        <hr>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Assunto</th>
                <th scope="col" colspan="3" class="text-center"> Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="creator in creators" :key="creator.id" @click="goToViewContent(creator.id)" class="table-row">
                    <th scope="row">{{creator.id }}</th>
                    <td>{{ limitString(creator.name, 20) }}</td>
                    <td>{{ limitString(creator.subject, 30) }}</td>
                    <td>
                        <td class="text-center">
                            <button v-if="isLoggedIn" @click="editPost(creator.id); stopEvent($event)" type="button" class="btn btn-warning" title="Editar">
                               <i class="bi bi-pencil-square"></i>
                            </button>
                            <button @click="goToViewContent(creator.id)" type="button" class="btn btn-info" title="Visualizar">
                               <i class="bi bi-eye"></i>
                            </button>
                            <button v-if="isLoggedIn" @click="confirmDelete(creator.id); stopEvent($event)" type="button" class="btn btn-danger" title="Excluir">
                               <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </td>
                </tr>
            </tbody>
            <notifications group="foo"/>
        </table>
        <laravel-vue-pagination :data="pagination" @pagination-change-page="changePage" simple>
        <template #current-nav>
        </template>
        <template #next-nav>
        </template>
        </laravel-vue-pagination>
    </div>
</template>

<script>
import Vue from 'vue';
import Notifications from 'vue-notification';
import LaravelVuePagination from 'laravel-vue-pagination';
import Swal from 'sweetalert2';
import axios from 'axios';
import '/css/styles.css';

Vue.use(Notifications);
Vue.component('laravel-vue-pagination', LaravelVuePagination);

    export default {
        computed: {
            truncatedRows() {
            return this.rows.map(row => ({
                ...row,
                name: this.truncateText(row.name, 15),
                subject: this.truncateText(row.subject, 15)
            }));
            }
        },
        mounted() {
            const urlParams = new URLSearchParams(window.location.search);
            const registroAtualizado = urlParams.get('registroatualizado');
            if (registroAtualizado === 'true') {
                this.$notify({
                    group: 'foo',
                    type: 'info',
                    title: 'Importante!',
                    text: 'Artigo atualizado com sucesso!'
                });
                window.history.replaceState({}, document.title, '/home');
            }

            const registroAdicionado = urlParams.get('registroadicionado');
            if (registroAdicionado === 'true') {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Sucesso!',
                    text: 'Novo registro adicionado com sucesso!'
                });
                window.history.replaceState({}, document.title, '/home');
            }
        },
        data() {
            return {
                titlemodal: '',
                searchTerm: '',
                axios: axios,
                creators: [],
                currentPage: 1,
                pagination: {}, // Make sure to define the pagination property here
                isLoggedIn: false
            }
        },
        methods: {
            updateComponent() {
                this.$forceUpdate();
            },
            stopEvent(event) {
                event.stopPropagation();
            },
            async list() {
                const res = await axios.get('creators?page=' + this.currentPage);
                this.creators = res.data.data;
                this.pagination = res.data;
            },
            changePage(page) {
                this.currentPage = page;
                this.list();
            },
            async search() {
                if (this.searchTerm === '') {
                // Call the list method to get all articles
                this.list();
                } else {
                // Search for articles by search term
                const res = await axios.get('/search', { params: { term: this.searchTerm } });
                this.creators = res.data;
                }
            },
            limitString(string, limit) {
                if (string.length > limit) {
                    return string.substring(0, limit) + '...';
                } else {
                    return string;
                }
            },
            async confirmDelete(id) {
                if (await this.$swal.fire({
                    title: 'Tem certeza?',
                    text: 'O registro será excluído permanentemente.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    return result.isConfirmed;
                })) {
                    this.excluir(id);
                }
            },
            async excluir(id) {
                try {
                    await this.axios.delete(`/creators/${id}`);
                    this.creators = this.creators.filter(creator => creator.id !== id);
                    this.list();
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Sucesso!',
                        text: 'Registro excluído com sucesso.'
                    });
                } catch (error) {
                    console.error(error);
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Erro!',
                        text: 'Ocorreu um erro ao excluir o registro.'
                    });
                }
            },
            goToViewContent(id) {
                window.location.href = '/view-content/' + id;
            },
            editPost(id) {
                window.location.href = `${id}/edit/`;
            },
            async goToArticle() {
                window.location.href = '/creation';
            }
        },
        async created() {
            this.list();
            this.$swal = Swal;
        },
        async beforeMount() {
            const res = await axios.get('/user');
            this.isLoggedIn = res.data.isLoggedIn;
        },
    }
</script>
