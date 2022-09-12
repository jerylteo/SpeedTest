let num = [1, 9, -3, -5, 8, 2, 15, -10];
let output = [];

for(let i in num) {
    output[i] = num[i] < 0?num[i] : undefined;
}

num.sort((a,b)=>{
    return a-b;
})
let sorted =num.filter(n=>n>0);
let sortedIndex = 0;
for(let i in output) {
    if(output[i]==undefined) {
        output[i]=sorted[sortedIndex];
        sortedIndex++;
    }
}
console.log(output);
