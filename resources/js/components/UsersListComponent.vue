<template>
    <div class="container">
         <div class="row">
            <div class="col-sm" v-for="(user , userIndex) in userChatList" :key="userIndex">
            <div class="card" style="width: 18rem;">
            <center>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJaIMtn33rncoKiTNyOdgfJXYOpVL-7of52Ztq5UCqLVRC2TLhBkbsUHVmFYs4V4pwWkQ&usqp=CAU" class="card-img-top center"
                    style="width:200px;"
                    alt="Prifile Image">
            </center>
                <div class="card-body">
                    <h5 class="card-title">{{user.name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" @click.prevent="connectWithUser(user)" class="btn btn-primary">Connect to chat</a>
                </div>
            </div>
            </div>  
        </div>
    </div>
</template>

<script>
export default {
    name: "UsersListComponent",
    data() {
        return {
            userChatList: [],
            attributes:null,
        };
    },
    methods: {
        connectWithUser:function(user) {
            let url = `${baseUrl}/chat/create-channel`;
            this.$axios.post(url, user)
                .then((response) => {
                    if(response.status == 200){
                        if(response.data.status != 100){
                           window.location.href =  `${baseUrl}/home`;
                        }
                    }
                }).catch((error) => {
                    console.log(error);
                    console.log("Something Went wrong, please try again after sometimes")
                })
        },
        getUserList:function () { 
            let url = `${baseUrl}/chat/user-list`;
            this.$axios.post(url, this.attributes)
                .then((response) => {
                    if(response.status == 200){
                        if(response.data.status == 200){
                            this.userChatList = response.data.userList;
                        }
                    }
                }).catch((error) => {
                    console.log(error);
                    console.log("Something Went wrong, please try again after sometimes")
                })
        }
    },
    mounted() {
      this.getUserList();

    },
};
</script>
