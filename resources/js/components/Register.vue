<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">register</div>

                    <div class="card-body">
                        {{ input }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            input: 'register'
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
