   
    <template>
      
     <div class="card  mb-4">
                       <div class="card-header text-uppercase">
                       {{quizz.name}}
                       <span class="float-right">{{questionIndex+1}}/{{question.length}}</span>
                            <p class="text-danger">{{times}}</p>
                       </div>
                       <div class="card-body">
                           <div v-for="(question,index) in questions" v-bind:key="index">
                                 <div v-show="index==questionIndex">

                             <h4>  {{question.question}} </h4>
                             <div  v-for="answer in question.answers" v-bind:key="answer">
                                 <ul class="list-group">
                                     <li class="list-group-item">
                                    <input type="radio" :value="answer.is_correct
                                                                ?true
                                                                :answer.answer
                                                                
                                    "
                                        :name="index"
                                        v-model="userResponse[index]"
                                        @click="userQuestion=question.id;
                                                userAnswer=answer.id
                                        "
                                        >    
                                    
                                    {{answer.answer}}
                                     </li>
                                 </ul>
                             </div>
                           </div>
                       </div>
                       </div>
                     <div class="card-footer">
                                                     
                         <div v-show="questionIndex != questions.length">
                    <button  class="btn btn-primary float-left" @click="
                       prev()
                       
                       " > Previous</button>
                        <button class="btn btn-primary float-right" 
                         @click=" next();
                         register()
                            
                        ">Next</button>
                         </div>
                         <div v-show="questionIndex === questions.length">
                             <p>You got {{score()}} out of {{questions.length}}</p>
                         </div>
                        
                     </div>
                   </div>
    </template>
    
    <script>
        import moment from "moment";

    export default {
    props:['time','question','quizzdata'],
    data(){
        return {
            questions :this.question,              
            questionIndex:0,
            quizz:this.quizzdata,
            userResponse:Array(this.question.length).fill(false),
            userAnswer:0,
            userQuestion:0,
                clock: moment.utc(this.time*60*1000)
                    }
    },
    mounted(){
        setInterval(() => {
            this.clock = moment(this.clock.subtract(9, 'seconds'))

            }, 1000);
  

    },

    computed: {
            times: function(){
            var minsec=this.clock.format('mm:ss');
            if(minsec=='00:00'){
                alert('timeout')
         
            }
                return minsec
            }
        },
methods:{
prev(){
    if(this.questionIndex<=0)
    {
    return  this.questionIndex=this.question.length-1
    }
        this.questionIndex--
   
    
},
next(){
     if(this.questionIndex>=this.question.length)
    {
       return this.questionIndex=0
    }
    ++this.questionIndex
},
result(question,amswer){
    this.userQuestion=question
    this.userAnswer=answer
    console.log(this.userQuestion)
},
score(){
    return this.userResponse.filter(
        val => val=== true
    ).length
},
register(){
    axios.post('/result/create',{
        answerid:this.userAnswer,
        questionid:this.userQuestion,
        quizzid:this.quizz.id

    })
        .then(res=>console.log(res))
            .catch(err=>console.log(err))
}


}
    }

    </script>
    
    <style>
    
    </style>script>
