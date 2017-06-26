<template>
    <div class="container">
        <div class="text-center">
            <div class="row" style="margin-bottom: 10px">
                <vue-core-image-upload  v-if="!reset"
                        class="btn btn-primary"
                        :crop="false"
                        :headers="csrf_token"
                        text="Upload Images"
                        @imageuploaded="imageUploded"
                        :max-file-size="5242880"
                        :multiple="true"
                        :multiple-size="4"
                        inputOfFile="rom_images"
                        url="/rom/" >
                </vue-core-image-upload>
                <button v-else class="btn btn-warning"  @click="start_over()">Start Over</button>
                <a :href="download_path" class="btn btn-success" v-if="download">Download</a>
                <button class="btn btn-success" v-else @click="build()">ROMify</button>

        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="list-group sorted_list">
                    <li class="list-group-item media img-list"  v-for="item in rom_images" :data-id="item.id" :key="item.formatted_name" >
                        <a class="media-left" href="#">
                            <img class="media-object img-thumb" :src="https://item.image_path" :alt="item.formatted_name">
                            <!--<img class="media-object"  src="img/avatar-ecma.png" alt="Responsive image"/>-->
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{item.formatted_name}}</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>



    </div>
</template>
<script>
    import VueCoreImageUpload from 'vue-core-image-upload';
    export default {
        mounted() {
            this.initsort();
        },
        components: {
            VueCoreImageUpload,
        },
        data() {
            return {
                download: false,
                reset: false
            }
        },
        methods: {
            imageUploded(res) {
                console.log(res);
                if(res.status == 'success') {
                    this.download = false;
                    console.log(res);
                    this.$store.commit('update_rom', res.data);
                }
                new Noty({
                    type: res.status,
                    text: res.message
                }).show();
            },
            initsort(){
                $('.sorted_list').sortable({
                });
            },
            build(){
                if(this.rom_id){
                    var img_order = [];
                    $('li.img-list').each(function() {
                        img_order.push($(this).data('id'));
                    })

                    axios.post('/rom/build/'+this.rom_id,{img_order:img_order}).then((resp) => {
                        console.log(resp.data);
                        if (resp.data.status == 'success'){
                            this.download = true;
                            this.$store.commit('update_rom', resp.data.data.rom);
                        }else{
                            this.reset=true;
                        }
                        new Noty({
                            type: resp.data.status,
                            text: resp.data.message
                        }).show();
                    });
                }else{
                    new Noty({
                        type: 'info',
                        text: 'Please upload images first'
                    }).show();
                }

            },
            start_over(){
                this.$store.commit('reset');
                this.reset = false;
            }

        },
        computed: {
            csrf_token(){
                return {'X-CSRF-Token': Laravel.csrfToken};
            },
            rom_images(){
                return this.$store.getters.all_rom_images;
            },
            rom_id(){
                return this.$store.getters.rom_id;
            },
            download_path(){
                return this.$store.getters.download_path;
            }
        }
    };
</script>


<style>
    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    ul.sorted_list li.placeholder {
        position: relative;
        /** More li styles **/
    }
    ul.sorted_list li.placeholder:before {
        position: absolute;
        /** Define arrowhead **/
    }
    img.img-thumb{
        width: 80px;
        height: 80px;
    }
</style>
