#  > maior que
#  >= Maior que ou igual
#  < Menor que
#  <= Menor que ou igual
#  == Extremamente igual
#  != Diferente

def MaiorMenor(nums1, nums2):
    if nums1 > nums2:
        print(
            f"Número 1: {nums1}, é maior que "
            f"o número 2: {nums2}"
            )
    else:
        print(
            f"Número 2: {nums2}, é maior que "
            f"o número 1: {nums1}"
            )
        
result1 = int(input("Número 01: "))
result2 = int(input("Número 02: "))

teste = MaiorMenor(result1, result2)

print(teste)


