# target = 9 [11, 15, 2, 7]
# solução 2 usando sort
# solução 3 usando hash

class solution:
    def twoSum(self, nums: list[int], target: int) -> list[int]:
        hasher = {}
        for idx, i in enumerate(nums):
            if hasher.get(i) is not None:
                return[hasher.get(i), idx]
            hasher[target-i] = idx

sol = solution()
target = 9
nums = [2, 7, 11, 15]

result = sol.twoSum(nums, target)
print(f'Índices: {result}')
print(f'Valores: {nums[result[0]]} + {nums[result[1]]} = {target}')

print(sol.twoSum([3,2,4], 6))       #Tem que retonar[1, 2]
print(sol.twoSum([3,3], 6))         #tem que retornar [0, 1]
print(sol.twoSum([2,5,5,11], 10))   #tem que retornar [1, 2]