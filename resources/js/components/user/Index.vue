<template>
    <div class="bg-slate-700 flex min-h-screen">
        <div class="bg-white m-auto border border-2 rounded-md p-2">
            <div class="mb-6">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filtro:</label>
                <input type="text" id="search" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg
                        bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Digite o que deseja filtrar..."
                       v-model="search">
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">Uid</th>
                <th class="px-6 py-3">Nome</th>
                <th class="px-6 py-3">Sobrenome</th>
                <th class="px-6 py-3">E-mail</th>
                <th class="px-6 py-3">Genero</th>
                <th class="px-6 py-3">Telefone</th>
                </thead>
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-for="user in paginatedUsers" :key="user.uid" v-if="paginatedUsers ? paginatedUsers.length > 0 : false">
                    <td class="px-6 py-4">{{ user.uid }}</td>
                    <td class="px-6 py-4">{{ user.first_name }}</td>
                    <td class="px-6 py-4">{{ user.last_name }}</td>
                    <td class="px-6 py-4">{{ user.email }}</td>
                    <td class="px-6 py-4">{{ user.gender }}</td>
                    <td class="px-6 py-4">{{ user.phone_number }}</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-else>
                    <td class="px-6 py-4">Nenhum usuário encontrado!</td>
                </tr>
                </tbody>
            </table>
            <div class="mt-2 flex justify-end">
                <vue-awesome-paginate
                    v-model="currentPage"
                    :page-count="pageCount"
                    :click-handler="changePage"
                    :total-items="users.length"
                    :show-breakpoint-buttons="false"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";

//Variaveis de usuário e o campo de pesquisa para o filtro.
let users = ref('');
let search = ref([]);

//Variaveis de página atual e quantidade de itens por página.
let currentPage = ref(1);
const itemsPerPage = 10;

//Resgatando os usuários quando o componente é montado
onMounted(async () => {
    getUsers();
});

//Função que resgata os usuários por axios na nossa API.
const getUsers = async () => {
    let response = await axios.get('/api/v1/users');
    users.value = response.data.users;
};

//Função padrão que retorna os usuários buscados no filtro ou retorna todos.
const searchUsers = computed(() => {
    if (search.value == '') {
        return users.value;
    } else {
        const query = search.value;
        currentPage.value = 1;
        return users.value.filter(user => {
            return (
                user.first_name.toLowerCase().includes(query) ||
                user.last_name.toLowerCase().includes(query) ||
                user.email.toLowerCase().includes(query) ||
                user.gender.toLowerCase().includes(query) ||
                user.phone_number.includes(query)
            );
        });
    }
});

//Função que calcula o total de páginas necessárias para exibir todos os resultados da pesquisa.
const pageCount = computed(() => {
    return Math.ceil(searchUsers.value.length / itemsPerPage);
});

//Função que retorna o range certo de usuários bom base na página atual e o número total de registros por página.
const paginatedUsers = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return searchUsers.value.slice(startIndex, endIndex);
});

//Função que é chamada quando a página muda para atualizar a variavel de página atual.
const changePage = (page) => {
    currentPage = page;
};

</script>

<style>
.pagination-container {
    display: flex;
    column-gap: 10px;
}
.paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: rgb(242, 242, 242);
    border: 1px solid rgb(217, 217, 217);
    color: black;
}
.paginate-buttons:hover {
    background-color: #d8d8d8;
}
.active-page {
    background-color: #3498db;
    border: 1px solid #3498db;
    color: white;
}
.active-page:hover {
    background-color: #2988c8;
}
</style>

