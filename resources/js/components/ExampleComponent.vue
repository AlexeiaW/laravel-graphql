<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List all hobbies</div>

                    <div class="card-body">
                        <div>Your hobby: {{ hobby.name }}</div>

                        <div>
                            <h1>User</h1>
                            <div>{{ user.name }}</div>
                            <div>{{ user.email }}</div>
                            <div>Users hobbies</div>
                            <li v-for="hobby in user.hobbies" :key="hobby.id">
                                {{ hobby.name }}
                            </li>
                        </div>

                        <h1>All hobbies</h1>
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
    data() {
        return {
            hobbies: [],
            hobby: {},
            user: {}
        };
    },
    apollo: {
        // Simple query that will update the 'hello' vue property
        hobbies: {
            query: gql`
                query {
                    hobbies {
                        id
                        name
                    }
                }
            `
        },
        hobby: {
            query: gql`
                query {
                    hobby(id: 1) {
                        name
                    }
                }
            `
        },
        user: {
            query: gql`
                query {
                    user(id: 1) {
                        id
                        name
                        email
                        hobbies(first: 10) {
                            data {
                                id
                                name
                            }
                            paginatorInfo {
                                currentPage
                                lastPage
                            }
                        }
                    }
                }
            `
        }
    }
};
</script>
