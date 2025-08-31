class solution:
    def fizzbuzz(self, n: int) -> list[str]:
        ret = []
        for i in range(1, n+1):
            div_3 = (i % 3 == 0)
            div_5 = (i % 5 == 0)

            if div_3 and div_5:
                s = 'FizzBuzz'
            elif div_3:
                s = 'Fizz'
            elif div_5:
                s = 'Buzz'
            else:
                s = str(i)
                
            ret.append(s)
        return ret

sol = solution()
result = sol.fizzbuzz(20)
print(result)

