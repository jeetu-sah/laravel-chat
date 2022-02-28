<template>
    <div class="inbox_chat">
                    <div class="chat_list" 
                        v-if="(userChatList.length > 0)"
                        :class="(activeChatTabId == user.id) ? 'active_chat' : ''"
                        v-for="(user, userIndex) in userChatList" :key="userIndex"
                        @click.prevent="activeChat(user)"  >
                        <div class="chat_people">
                            <div class="chat_img">
                                <img
                                    src="https://ptetutorials.com/images/user-profile.png"
                                    :alt="user.friend_details.name"
                                />
                            </div>
                            <div class="chat_ib">
                                <h5>
                                    {{user.friend_details.name}}
                                    <span class="chat_date">Dec 25</span>
                                </h5>
                                <p>
                                    {{user.friend_details.bio}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list" v-else>
                        <div class="chat_people">
                            <div class="chat_img">
                                <img
                                    src="https://ptetutorials.com/images/user-profile.png"
                                    alt="sunil"
                                />
                            </div>
                            <div class="chat_ib">
                                <h5>
                                    No user chats available
                                    <span class="chat_date">Dec 25</span>
                                </h5>
                                <p>
                                    Test, which is a new approach to have
                                    all solutions astrology under one roof.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
</template>
<script>
export default {
    name: "ContactlistComponent",
    data() {
        return {
            userChatList: [],
            attributes:null,
            activeChatTabId:null,
            activeChannelMsgHeader:{
                name:"Default Name"
            },
            user: window.Laravel.user,
        };
    },
    methods: {
        activeChat:function(chat) {
            this.activeChatTabId = chat.id;
            this.$eventBus.$emit('activeChatTab',chat);
        },
        getUserChatList:function () { 
            let url = `${baseUrl}/chat/chat-user-list`;
            this.$axios.post(url, this.attributes)
                .then((response) => {
                    if(response.status == 200){
                        if(response.data.status == 200){
                            this.userChatList = response.data.userList;
                            //load active chat
                            this.activeChat(response.data.userList[0]);
                        }
                    }
                }).catch((error) => {
                    console.log(error);
                    console.log("Something Went wrong, please try again after sometimes")
                })
        }
    },
    beforeMount() {
        this.getUserChatList();
    }
};
</script>
<style scoped>
.container {
    max-width: 1170px;
    margin: auto;
}
img {
    max-width: 100%;
}
.inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 30%;
    border-right: 1px solid #c4c4c4;
}
.no_chats{
    text-align: center;
     margin-top: 25px;
}
.inbox_msg {
    border: 1px solid #c4c4c4;
    clear: both;
    overflow: hidden;
}
.top_spac {
    margin: 20px 0 0;
}

.recent_heading {
    float: left;
    width: 40%;
}
.srch_bar {
    display: inline-block;
    text-align: right;
    width: 60%;
}
.headind_srch {
    padding: 10px 29px 10px 20px;
    overflow: hidden;
    border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
}
.srch_bar input {
    border: 1px solid #cdcdcd;
    border-width: 0 0 1px 0;
    width: 80%;
    padding: 2px 0 4px 6px;
    background: none;
}
.srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
}
.srch_bar .input-group-addon {
    margin: 0 0 0 -27px;
}

.chat_ib h5 {
    font-size: 15px;
    color: #464646;
    margin: 0 0 8px 0;
}
.chat_ib h5 span {
    font-size: 13px;
    float: right;
}
.chat_ib p {
    font-size: 14px;
    color: #989898;
    margin: auto;
}
.chat_img {
    float: left;
    width: 11%;
}
.chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
}

.chat_people {
    overflow: hidden;
    clear: both;
}
.chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
    cursor: pointer;
}
.inbox_chat {
    height: 550px;
    overflow-y: scroll;
}

.active_chat {
    background: #ebebeb;
}

.incoming_msg_img {
    display: inline-block;
    width: 6%;
}
.received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
}
.received_withd_msg p {
    background: #ebebeb none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
.time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
}
.received_withd_msg {
    width: 57%;
}
.mesgs {
    float: left;
    padding: 9px 0px 0 19px;
    width: 70%;
}
.sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
.outgoing_msg {
    overflow: hidden;
    margin: 26px 0 26px;
}
.sent_msg {
    float: right;
    width: 46%;
}
.input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
}

.type_msg {
    border-top: 1px solid #c4c4c4;
    position: relative;    
}
.msg_send_btn {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
}
.messaging {
    padding: 0 0 50px 0;
}
.msg_history {
    height: 516px;
    overflow-y: auto;
}
</style>

