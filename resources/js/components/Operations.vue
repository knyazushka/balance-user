<template>
    <form @submit.prevent="search" class="row" method="post">
        <div class="row">
            <div class="col">
                <input type="text" v-model="description" name="description" id="description" class="form-control" placeholder="Описание">
            </div>
            <div class="col">
                <select class="form-select" v-model="sorting" name="sorting" id="sorting">
                    <option selected>Как сортируем?</option>
                    <option value="asc">По убыванию</option>
                    <option value="desc">По возрастанию</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" @click="search" class="btn btn-primary btn-block">Искать</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Операция</th>
            <th>Описание</th>
            <th>Сумма</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="operation in operations">
            <td>{{ operation.id }}</td>
            <td>
                <span v-if="operation.type === 'in'" class="badge bg-success">Приход</span>
                <span v-else class="badge bg-danger">Уход</span>
            </td>
            <td>{{ operation.description }}</td>
            <td>{{ operation.sum }}</td>
            <td>{{ operation.created_at }}</td>
        </tr>
        </tbody>
    </table>
</template>
<script>
import axios from "@/axios";

export default {
    data() {
        return {
            operations: [],
            description: '',
            sorting: '',
        };
    },
    methods: {
        async search() {
            axios.post('/operations/list', {
                description: this.description,
                sort: this.sorting,
            })
                .then((response) => {
                    this.operations = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
    },
    created() {
        this.search();
    }
}
</script>
