<template>
    <div class="container">
        <!--Contener todo en al menos un div -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <p> I'm an example component! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : [],
        
        mounted() {
            console.log('Component mounted.');
        },
        
        data() {
            return {
                variable: false
            };
        },

        methods: {
        }
    };
</script>