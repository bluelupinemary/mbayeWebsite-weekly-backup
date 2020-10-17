<template>
 <p class="button-number">{{this.commentcount}}</p>
</template>

<script>
import EventBus from '../../frontend/event-bus';
export default {
    data:function() {
            return{
                commentcount: '0',
        }
      },
     methods: {
    countcomment (commentcount) {
      this.commentcount = commentcount;
    }
  },
  mounted () {
    EventBus.$on('commentcount', (commentcount) => {
      this.countcomment(commentcount);
    })
  }
}       
</script>
 