<!-- <template>
    <div class="panel panel-default">
        <div class="panel-heading">¿En qué estás pensando ahora?</div>

        <div class="panel-body">
            <form action="" v-on:submit.prevent="newThought()">
                <div class="form-group">
                    <label for="thought">Ahora estoy pensando en:</label>
                    <input type="text" class="form-control" name="thought" v-model="desdep">
                    <input type="text" class="form-control" name="some" v-model="hastap">
                </div>
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                desdep: '',
                hastap: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newThought() {
                const params = {
                    desdep: this.desdep,
                    hastap: this.hastap
                };
                this.desdep = '';
                this.hastap = '';
                axios.get('/exports/pdf', params)
                    .then((response) => {
                        const thought = response.data;
                        this.$emit('new', thought);
                    });
            }
        }
    }
</script> -->