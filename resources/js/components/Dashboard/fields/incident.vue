<template>
  <div class="card">
    <h3 class="fieldTitle">
      incident
    </h3>

    <div>
      <ul class="chips w-full"  >
        <li class="chip" v-for='(chip) in get_incidentsData' >
          <span>
            {{chip.item}}
          </span>
          <button class="chipDeleteButton">
            x
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  
  export default{
    computed: {
      get_incidentsData: function () {
        const data = this.all_incidents;
        let filteredData = [];
        if (data) {
            filteredData = data.map((item) => {
                return { id: item.id, item: item.incident };
            });
        }

        return filteredData;
    },
    },
    props: {
      all_incidents: Array
    }
  }
</script>