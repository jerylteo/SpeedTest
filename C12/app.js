function arithmetic(expression) {
    expression = expression.replace("^","**");
    return eval(expression);
    
}