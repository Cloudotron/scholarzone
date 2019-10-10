args = commandArgs(trailingOnly = TRUE)

load("Model3.Rdata")

X10th = as.integer(args[1])
X12th = as.integer(args[2])
Degree = as.integer(args[3])

test = as.data.frame(cbind(X10th,X12th,Degree))

predict(model3,test)
