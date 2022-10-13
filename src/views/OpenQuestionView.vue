<template>
  <main>
    <div class="title-page">
      Нові відповіді
    </div>
    <section class="OpenQuestions" v-if="data.notCheked">
      <div class="open-question" v-for="(notCheked, index) in data.notCheked" v-bind:key="notCheked.id">
        <div class="question">{{index+1}}.{{notCheked.open_question.question}}</div>
        <div class="answer">{{notCheked.open_question.answer}} Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis</div>
        <div class="submit-panel">
          <div class="btn">
            <span class="material-icons">check</span>
            Перевірив
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'

const data = reactive({
  notCheked: null,
})
const getClassroom = function () {
  axios({
    method: 'GET',
    url: `api/audit-open-question`,
    data: {}
 }).then(function (response) {
   data.notCheked = response.data
   console.log(data.notCheked)

  })
}
getClassroom()
</script>

<style lang="scss" scoped>
main{
  padding: 16px;
}
.title-page{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  font-size: 2.5rem;
  font-weight: 600;
  color: #6f40fe;
  margin-bottom: 16px;
}
.open-question{
  display: flex;
  flex-direction: column;
  background: #f0f1f2;
  padding: 24px;
  border-radius: 8px;
  .question{
    width: 100%;
    font-size: 1.5rem;
    color: #6f40fe;
    margin-bottom: 8px;
  }
  .answer{
    flex-grow: 1;
    padding: 16px;
    margin-bottom: 16px;
    outline: 1px solid rgba(146, 145, 156, 0.4117647059);
    border-radius: 5px;
    background: #ffffff;
  }
  .submit-panel {
    justify-content: flex-end;
  }
}
</style>
