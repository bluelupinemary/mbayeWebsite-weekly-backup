<template>
 <p class="button-number">{{this.naffcount}}</p>
</template>

<script>
import EventBus from '../../frontend/event-bus';
export default {
    data:function() {
            return{
                hotcount: '',
                coolcount: '',
                naffcount: '',
        }
      },
     methods: {
    countemotions (emo) {
      this.hotcount = emo.hotcount;
      this.coolcount = emo.coolcount;
      this.naffcount = emo.naffcount;
    }
  },
  mounted () {
    EventBus.$on('GeneralEmotion_sent', (emo) => {
      this.countemotions(emo);
    })
  }
}       
</script>
 