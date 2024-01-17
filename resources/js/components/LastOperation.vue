<template>
    <div class="operations-last">

        <p>Последние операции</p>
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
            <tr v-for="operation in lastOperations">
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
    </div>
</template>

<script>
import axios from "@/axios";

export default {
    data() {
        return {
            lastOperations: []
        };
    },
    created() {
        axios.post('/operations')
            .then((response) => {
                this.lastOperations = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
    }
}

</script>
