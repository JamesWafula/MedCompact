<template>
  <div class="graphChart">
    <v-chart class="chart" :autoresize="true" :option="options" />
  </div>
</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { BarChart, PieChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
  CanvasRenderer,
  PieChart,
  BarChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
]);

export default {
  name: "HelloWorld",
  components: {
    VChart,
  },
  provide: {
    [THEME_KEY]: "light",
  },
  autoresize: true,
  data() {
    return {};
  },
  computed: {
    options() {
      let occupation = null;

      if (this.occupation_data) {
        occupation = this.occupation_data;
      }
      let occupation_labels = occupation.map(
        (item) => item.occupation.toLowerCase().substring(0, 9) + "..."
      );
      let occupation_info = occupation.map((item) => item.errorCount);
      return {
        title: {
          text: "occupation",
          left: "center",
        },

        tooltip: {
          trigger: "item",
          formatter: " {b} : {c}",
        },
        xAxis: {
          type: "category",
          data: occupation_labels,
          axisLabel: {
            rotate: 45,
          },
        },
        yAxis: {
          type: "value",
        },
        series: [
          {
            data: occupation_info,
            type: "bar",
          },
        ],
      };
    },
  },
  props: {
    occupation_data: Array,
  },
};
</script>

<style scoped>
.chart {
  height: 400px;
}
</style>
