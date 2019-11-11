<template lang="">
    <div>
        <div class="container">
                <div class="bg-form-service-email">
                    <form action="" method="post" v-on:submit.prevent="onSubmit">
                        <input type="text" name="nama" id="nama" class="form-control form-service" placeholder="Name*" v-model="info.name"> <br><br>
                        <input type="email" name="email" id="email" class="form-control form-service" placeholder="Email*" v-model="info.email"> <br><br>
                        <input type="text" name="industry" id="industry" class="form-control form-service" placeholder="Sector Of Industry*" v-model="info.industry"> <br><br>

                        <h5>Items You've Picked : </h5> <br><br>

                        <textarea name="message" id="message" cols="30" rows="10" class="form-control form-service2" placeholder="Message*" v-model="info.message"></textarea> <br><br>

                        <button type="submit" class="btn form-service3">SEND</button>
                    </form>
                </div>
            </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
            return {
                info:[],
                success:false
            }
    },
    methods:{
            onSubmit(){
                axios.post(process.env.MIX_API_URL+'user/kirimform',
                    {
                        name:this.info.name,
                        email:this.info.email,
                        industry:this.info.industry,
                        message:this.info.message,
                    })
                  .then(response => {
                    console.log(response);
                      this.success = response.data.success;
                      if(this.success){
                        this.$router.push({
                            name:'successmail',
                            params:{
                                success:this.success,
                                name:this.info.name,
                                email:this.info.email,
                                industry:this.info.industry,
                                message:this.info.message,
                            }
                        });
                      }
                  })
                  .catch(error => {
                    console.log(error)
                    this.success = false
                  });

            }
        }
}
</script>
