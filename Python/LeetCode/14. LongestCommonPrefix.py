class Solution:
    def longestCommonPrefix(self, strs: list[str]) -> str:
        if not strs:
            return "o"
    
        result = ""
    
        for i in range(len(strs[0])):
            char = strs[0][i].lower() # Converte para minúscula
        
            for word in strs[1:]:
                if i >= len(word) or word[i].lower() != char:
                    return result
        
            result += strs[0][i] # Adiciona o caractere ORIGINAL
    
        return result
    
class solution2:
    def longestCommonPrefix(self, strs: list[str]) -> str:
        if not strs:
            return ""
        
        prefix = strs[0]
        
        for word in strs[1:]:
            while prefix and not word.startswith(prefix):
                prefix = prefix[:-1]
        
        return prefix


sol = Solution()
sol2 = solution2()
print(sol.longestCommonPrefix(['flower', 'fly', 'flight']))
print(sol.longestCommonPrefix(['luan', 'luis', 'Lucas']))
print(sol.longestCommonPrefix(['dog', 'racecar', 'car']))