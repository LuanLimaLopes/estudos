import { useForm } from "react-hook-form";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "./ui/card";
import { z } from "zod/v4"
import { zodResolver } from "@hookform/resolvers/zod"
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from "./ui/form";
import { Input } from "./ui/input";
import { Textarea } from "./ui/textarea";
import { Button } from "./ui/button";
import { useCreateRoom } from "@/http/use-create-room";


const createRoomSchema = z.object({
    name: z.string().min(3, { message: 'Inclua no minímo 3 caracteres' }),
    description: z.string(),
})

type CreteRoomFormData = z.infer<typeof createRoomSchema>

export function CreateRoomForm() {

    const { mutateAsync: createRoom } = useCreateRoom()

    const CreateRoomForm = useForm<CreteRoomFormData>({
        resolver: zodResolver(createRoomSchema),
        defaultValues: {
            name: '',
            description: '',
        },
    })

    async function handleCreateRoom({
        name,
        description,
    }: CreteRoomFormData) {
        await createRoom({ name, description })

        CreateRoomForm.reset()
    }


    return (
        <Card>
            <CardHeader>
                <CardTitle>Criar Sala</CardTitle>
                <CardDescription>
                    Crie uma nova sala para fazer perguntas e receber respostas da I.A
                </CardDescription>
            </CardHeader>
            <CardContent>
                <Form {...CreateRoomForm}>
                    <form onSubmit={CreateRoomForm.handleSubmit(handleCreateRoom)} className="flex flex-col gap-4">
                        <FormField
                            control={CreateRoomForm.control}
                            name="name"
                            render={({ field }) => {
                                return (
                                    <FormItem>
                                        <FormLabel>Nome da sala</FormLabel>
                                        <FormControl>
                                            <Input {...field} placeholder="Digite o nome da sala..." />
                                        </FormControl>
                                        <FormMessage />
                                    </FormItem>
                                )
                            }}
                        />

                        <FormField
                            control={CreateRoomForm.control}
                            name="description"
                            render={({ field }) => {
                                return (
                                    <FormItem>
                                        <FormLabel>Descrição</FormLabel>
                                        <FormControl>
                                            <Textarea {...field} />
                                        </FormControl>
                                        <FormMessage />
                                    </FormItem>
                                )
                            }}
                        />


                        <Button type="submit" className="w-full">Criar sala</Button>
                    </form>
                </Form>
            </CardContent>
        </Card>
    )
}   