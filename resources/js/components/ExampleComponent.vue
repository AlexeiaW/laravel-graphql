<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List all hobbies</div>

                    <div class="card-body">
                        <div>Your hobby: {{ hobby }}</div>

                        <li v-for="hobby in hobbies" :key="hobby.id">
                            {{ hobby.name }}
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import gql from "graphql-tag";

export default {
    apollo: {
        // Simple query that will update the 'hello' vue property
        hobbies: gql`
            query {
                hobbies {
                    id
                    name
                }
            }
        `,
        hobby: {
            query: gql`
                query {
                    hobby(id: 1) {
                        name
                    }
                }
            `,
            update: data => data.hobby.name
        }
    }
};
</script>
