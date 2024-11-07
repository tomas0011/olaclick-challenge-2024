<template>
  <div class="table">
    <h1>Esta es mi primera aplicacion en VUE</h1>
    <table>
      <tr>
        <th>
          Nombre
        </th>
        <th>
          Apellido
        </th>
      </tr>
      <tr>
        <td>
          Tomas
        </td>
        <td>
          Vasquez
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  name: 'Table',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.table {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
