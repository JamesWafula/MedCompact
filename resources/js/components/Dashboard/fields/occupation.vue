<template>
  <div class="card">
    <h3 class="fieldTitle">
      outcome
    </h3>

    <div>
      <ul class="chips w-full"  >
        <li class="chip" v-for='(chip) in get_chipData' >
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
      get_chipData: function () {
        const data = this.all_occupations;
        let filteredData = [];
        if (data) {
            filteredData = data.map((item) => {
                return { id: item.id, item: item.occupation };
            });
        }

        return filteredData;
    },
    },
    props: {
      all_occupations: Array
    }
  }
</script>