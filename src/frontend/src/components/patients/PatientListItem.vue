<template>
  <li class="grid grid-flow-col w-auto border border-black mb-4 rounded shadow-sm hover:shadow-gray-600 hover:shadow-lg shadow-gray-600 cursor-pointer p-4">
    <div class="col-span-4 flex flex-col justify-around">
      <p>{{ patient.lastname }} {{ patient.firstname }}</p>
    </div>
    <div class="col-span-4 flex flex-col justify-around">
    </div>
    <div class="col-span-4 flex flex-col justify-around">
    </div>
  </li>
</template>

<script>
export default ({
  props: ['patient'],
})
</script>