//Ian
import {ref, computed, watch} from 'vue';

export function useBackend(backendData){
    //傳入該頁面的原始資料
    const rawData = ref([...backendData.value]);

    //過濾後資料(用於搜尋)
    const filterData = ref([...rawData.value]); 
    //預設第一頁開始
    const currentPage = ref(1); 
    //每頁渲染幾筆
    const perPage = ref(10); 
    //總共幾頁
    const totalPages = computed(() => {  
        return  Math.ceil(filterData.value.length/perPage.value);
      });
    //渲染幾筆(用於頁面v-for)
    const viewData = computed(() => {  
        const start = (currentPage.value - 1) * perPage.value;
        const end = start + perPage.value;
        return  filterData.value.slice(start, end);
    });

    // 監聽來源資料變化 以便於搜尋功能
    watch(() => backendData.value, (newData) => {
        rawData.value = [...newData.value];
        filterData.value = [...newData.value];
    });

    // 分頁按鈕顯示狀態(用於按鈕v-for)
    const visiblePages = computed(() => {
        const visible = [];
        const total = totalPages.value;
        const current = currentPage.value;
    
        if(total <= 4){
          for(let i = 1; i<= total; i++){
            visible.push(i);
          }
        }else{
          if(current <= 3){
            visible.push(1,2,3,"・・・",total);
          }else if(current >= total -2){
            visible.push("・・・",total -2, total - 1, total)
          }else{
            visible.push("・・・",current - 1, current, current +1, "・・・",total);
          }
        }    
        return visible;        
    });

    // 分頁按鈕動作函式
    const prePage = () => {
        if(currentPage.value > 1){
        currentPage.value--;
        }
    };

    const nextPage = () => {
        if(currentPage.value < totalPages.value){
        currentPage.value++;
        }
    };

    const thisPage = (page) => {
        if(page >= 1 && page !== "・・・")
        currentPage.value = page;
    };

    // 回傳所有可能用得到的變數以及函式
    return{
        filterData,
        currentPage,
        perPage,
        totalPages,
        viewData,
        visiblePages,
        prePage,
        nextPage,
        thisPage
    };
};
